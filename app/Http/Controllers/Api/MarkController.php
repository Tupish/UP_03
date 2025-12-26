<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MarkController extends Controller
{
    public function getStudentMarks(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            Log::info('Запрос оценок для пользователя', [
                'user_id' => $user->id,
                'role_id' => $user->role_id
            ]);

            // Проверяем, что пользователь - студент
            if (!$user->student) {
                Log::warning('Пользователь не является студентом', ['user_id' => $user->id]);
                return response()->json([
                    'message' => 'Только студенты могут просматривать оценки',
                    'data' => []
                ], 403);
            }

            // Получаем student_id
            $studentId = $user->student->student_id;
            Log::info('Получение оценок для студента', ['student_id' => $studentId]);

            // Получаем оценки студента с пагинацией
            $marks = Mark::where('student_id', $studentId)
                ->with(['subject' => function($query) {
                    $query->select('subject_id', 'subject_name');
                }])
                ->orderBy('date', 'desc')
                ->paginate(10);

            Log::info('Найдено оценок', ['count' => $marks->count()]);

            return response()->json([
                'success' => true,
                'data' => $marks->items(),
                'links' => [
                    'first' => $marks->url(1),
                    'last' => $marks->url($marks->lastPage()),
                    'prev' => $marks->previousPageUrl(),
                    'next' => $marks->nextPageUrl(),
                ],
                'meta' => [
                    'current_page' => $marks->currentPage(),
                    'last_page' => $marks->lastPage(),
                    'per_page' => $marks->perPage(),
                    'total' => $marks->total(),
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Ошибка при получении оценок', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ошибка при загрузке оценок',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getTeacherMarks(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            Log::info('Запрос оценок преподавателя', [
                'user_id' => $user->id,
                'role_id' => $user->role_id
            ]);

            // Проверяем, что пользователь - преподаватель
            if (!$user->teacher) {
                Log::warning('Пользователь не является преподавателем', ['user_id' => $user->id]);
                return response()->json([
                    'message' => 'Только преподаватели могут просматривать поставленные оценки',
                    'data' => []
                ], 403);
            }

            // Получаем teacher_id
            $teacherId = $user->teacher->teacher_id;
            Log::info('Получение оценок преподавателя', ['teacher_id' => $teacherId]);

            // Получаем оценки, поставленные преподавателем с пагинацией
            $marks = Mark::where('teacher_id', $teacherId)
                ->with([
                    'subject' => function($query) {
                        $query->select('subject_id', 'subject_name');
                    },
                    'student' => function($query) {
                        $query->select('student_id', 'user_id', 'group_id')
                            ->with([
                                'user' => function($q) {
                                    $q->select('id', 'first_name', 'last_name');
                                },
                                'group' => function($q) {
                                    $q->select('group_id', 'group_name');
                                }
                            ]);
                    }
                ])
                ->orderBy('date', 'desc')
                ->paginate(10);

            Log::info('Найдено поставленных оценок', ['count' => $marks->count()]);

            return response()->json([
                'success' => true,
                'data' => $marks->items(),
                'links' => [
                    'first' => $marks->url(1),
                    'last' => $marks->url($marks->lastPage()),
                    'prev' => $marks->previousPageUrl(),
                    'next' => $marks->nextPageUrl(),
                ],
                'meta' => [
                    'current_page' => $marks->currentPage(),
                    'last_page' => $marks->lastPage(),
                    'per_page' => $marks->perPage(),
                    'total' => $marks->total(),
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Ошибка при получении оценок преподавателя', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ошибка при загрузке оценок',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
