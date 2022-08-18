'use  strict';

$(function () {

  let bookmark = $('.bookmark-toggle');

  bookmark.on('click', function () {

    let $this = $(this);

    console.log($this);

    let markRecipeId = $this.data('recipes-id');


    $.ajax({

      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },

      method: 'POST',

      url: '/bookmark',

      data: {


        'recipe_id': markRecipeId

      },

    })


      .done(function (data) {
        // console.log(data);
        $this.toggleClass('marked');
        $this.next('.mark-counter').html(data.recipe_markes_count);
      })

      .fail(function () {
        console.log('fail');
      });
  });
});