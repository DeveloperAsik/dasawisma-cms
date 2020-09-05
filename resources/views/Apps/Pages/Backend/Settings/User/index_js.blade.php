<script>
    var el_carousel = '#carousel';
    var el_stories = 'stories';
    var el_content_homepage = 'content-homepage';
    var page_carousel = 1;

    var page_content = 1;
    var Ajax = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('index js successfully load', 'success', {timeOut: 2000});
                fnGetCarousel(el_carousel, page_carousel, 4);
                $(el_carousel).on('afterChange', function (event, slick, currentSlide) {
                    var meta_per_page = $(el_carousel).data('per_page');
                    var meta_total = $(el_carousel).data('total');
                    var meta_total_page = $(el_carousel).data('total_page');
                    if (slick.$slides.length === (currentSlide + 1) && page_carousel <= meta_total_page) {
                        page_carousel++;
                        console.log(page_carousel);
                        fnGetCarousel(el_carousel, page_carousel, meta_per_page, 'add');
                    }
                });
                fnSetStories(el_stories);
                fnSetContent(el_content_homepage, page_content, 15);
            }
        };

    }();

    jQuery(document).ready(function () {
        Ajax.init();
    });

</script>