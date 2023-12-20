$(function () {
  // タイトルをクリックすると
  $(".js-main_category").on("click", function () {
    // クリックした次の要素を開閉
    $(this).next().slideToggle(300);
    // タイトルにopenクラスを付け外しして矢印の向きを変更
    $(this).toggleClass("open");
  });


  // メインカテゴリーをクリックすると関連する要素が開く

  // いいねの追加
  $(document).on('click', '.favorite_btn', function (e) {
    e.preventDefault();
    $(this).addClass('un_favorite_btn');
    $(this).removeClass('favorite_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.favorite_counts' + post_id).text();
    var countInt = Number(count);
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/favorite/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      console.log(res);
      $('.favorite_counts' + post_id).text(countInt + 1);
    }).fail(function (res) {
      console.log('fail');
    });
  });

  // いいね削除
  $(document).on('click', '.un_favorite_btn', function (e) {
    e.preventDefault();
    $(this).removeClass('un_favorite_btn');
    $(this).addClass('favorite_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.favorite_counts' + post_id).text();
    var countInt = Number(count);

    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/unfavorite/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      $('.favorite_counts' + post_id).text(countInt - 1);
    }).fail(function () {
    });
  });

  $(document).on('click', '.favorite_c_btn', function (e) {
    e.preventDefault();
    $(this).addClass('un_favorite_c_btn');
    $(this).removeClass('favorite_c_btn');
    var post_comment_id = $(this).attr('post_comment_id');
    var count = $('.favorite_comment_counts' + post_comment_id).text();
    var countInt = Number(count);
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/favorite/comment/" + post_comment_id,
      data: {
        post_comment_id: $(this).attr('post_comment_id'),
      },
    }).done(function (res) {
      console.log(res);
      $('.favorite_comment_counts' + post_comment_id).text(countInt + 1);
    }).fail(function (res) {
      console.log('fail');
    });
  });

  $(document).on('click', '.un_favorite_c_btn', function (e) {
    e.preventDefault();
    $(this).removeClass('un_favorite_c_btn');
    $(this).addClass('favorite_c_btn');
    var post_comment_id = $(this).attr('post_comment_id');
    var count = $('.favorite_comment_counts' + post_comment_id).text();
    var countInt = Number(count);

    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/unfavorite/comment/" + post_comment_id,
      data: {
        post_comment_id: $(this).attr('post_comment_id'),
      },
    }).done(function (res) {
      $('.favorite_comment_counts' + post_comment_id).text(countInt - 1);
    }).fail(function () {
    });
  });
});
