'use  strict';

$(function () {

  let bookmark = $('.bookmark-toggle');

  let bookmarkRecipeId;

  bookmark.on('click', function () {
  
    let $this = $(this);

    bookmarkRecipeId = $this.data('recipeDetail-id');


    $.ajax({

      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },

      method: 'POST',

      url: '/bookmark',

      data: {
        'recipeDetail-id': bookmarkRecipeId
      },

    })


      .done(function (data) {
        $this.toggleClass('marked'); 
        $this.next('.bookmark-counter').html(data.recipe_bookmark_count);
      })

      .fail(function () {
        console.log('fail');
      });
  });
});