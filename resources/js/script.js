document.addEventListener('DOMContentLoaded',function (){
    const role=document.getElementById('role')
    const group=document.getElementById('group')

    role.addEventListener('change',function (){
        if (this.value === 'student'){
            group.style.display = 'block'
        }else{
            group.style.display='none';
        }
    })
})


