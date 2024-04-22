$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Silmek İstiyor musun?',
                    text: "Bu işlem Geri Alınamaz!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet Silmek İstiyorum!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Silindi!',
                        'İşlem Başarılı bir şekilde gerçekleşti.',
                        'success'
                      )
                    }
                  })


    });

  });
