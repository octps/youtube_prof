(function () {
  if (typeof window.youtube_prof === 'undefined') {
    window.youtube_prof = {};
  }
  if (typeof window.youtube_prof.members === 'undefined') {
    window.youtube_prof.members = {};
  }
  
  var m = window.youtube_prof.members;

  m.movie_select_button = function() {
    if ($(".movie_select").hasClass("show")) {
        $(".movie_select").removeClass("show");
    } else {
        $(".movie_select").addClass("show");
    }
  };

}());