document.addEventListener('DOMContentLoaded',function (){
    const role=document.getElementById('role');
    const group=document.getElementById('group');
    const grade=document.getElementById('grade');

    role.addEventListener('change',function (){
        if (this.value === 'student'){
            group.style.display = 'block';
            grade.style.display = 'block';
        }else{
            group.style.display='none';
            grade.style.display='none';
        }
    })
})


