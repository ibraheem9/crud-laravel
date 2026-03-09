helperUI = function ()
{
    return {
        //note:: used in init
        markAsideActiveMenuItem: function ()
        {
            var path = window.location.href;
            $('#kt_aside_menu_wrapper .menu-link').filter(function () {
                return this.href == path;
            }).addClass('active');

            $('#kt_header_nav .menu-link').filter(function () {
                return this.href == path;
            }).addClass('active');
        },
        scrollTop              : function ()
        {
            $('html, body').animate({scrollTop: 0}, 700);
        },
        scrollBottom         : function ()
        {
            $('html, body').animate({scrollTop: $(document).height()}, 700);
        },
        fixBootstrapModal    : function ()
        {
            // call this before showing SweetAlert:
            var modalNode = document.querySelector('.modal[tabindex="-1"]');
            if (!modalNode)
            {
                return;
            }

            modalNode.removeAttribute('tabindex');
            modalNode.classList.add('js-swal-fixed');
        },
        restoreBootstrapModal: function ()
        {
            // call this before hiding SweetAlert (inside done callback):
            var modalNode = document.querySelector('.modal.js-swal-fixed');
            if (!modalNode)
            {
                return;
            }

            modalNode.setAttribute('tabindex', '-1');
            modalNode.classList.remove('js-swal-fixed');
        },
        findPos              : function (obj)
        {
            //Finds y value of given object
            var curtop = 0;
            if (obj.offsetParent)
            {
                do
                {
                    curtop += obj.offsetTop;
                } while (obj = obj.offsetParent);
                return curtop;
            }
        },
        fixMultiModalOverlay: function ()
        {
            $(document).on('shown.bs.modal','.modal', function (e) {
                $('.modal.show').each(function (index) {
                    if(index>0){
                        $(this).css('z-index', 1101 + index*2);
                    }
                });
                $('.modal-backdrop').each(function (index) {
                    if(index>0){
                        $(this).css('z-index', 1101 + index*2-1);

                    }
                });
            });

        }
    }
}();
