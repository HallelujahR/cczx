$(function () {
    var IMG_PREFIX = 'demo/img/';
  
    (function () {
         //  Notification with image
        (function () {
            $('#basicInfoImage').click(function () {
                Lobibox.notify('info', {
                    img: IMG_PREFIX + '1.jpg',
                    msg: 'Lorem ipsum dolor sit amet against apennine any created, spend loveliest, building stripes.'
                });
            });
            
        })();
    })();
});