// // alert(25);
// // prompt("entrer un nom")
// $('body').delegate('.SchoolChange','change',function(){ // SchoolChange dans l'entete
//     var school_id = $(this).val();
//     $.ajax({
//         url:"{{ url('panel/student/getclass') }}",//tres important getClass dans select
//         type: "POST",
//         data:{
//             "_token": "{{ csrf_token() }}",
//             school_id:school_id,//id school passer en paramettre important 
//         },
//         dataType:"json",
//         success:function(response){

//         },
//     });
// });