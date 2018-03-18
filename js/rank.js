$(function(){
  $("#play").on("click", function(){
    videoControl("playVideo");
  });

  $("#pause").on("click", function(){
    videoControl("pauseVideo");
  });

  $("#stop").on("click", function(){
    videoControl("stopVideo");
  });

  $("#clear").on("click", function(){
    videoControl("clearVideo");
  });

  function videoControl(action){ 
    var $playerWindow = $('#popup-YouTube-player')[0].contentWindow;
    $playerWindow.postMessage('{"event":"command","func":"'+action+'","args":""}', '*');
  }

});

// (function () {
//   if (typeof window.youtube_prof === 'undefined') {
//     window.youtube_prof = {};
//   }
//   if (typeof window.youtube_prof.members === 'undefined') {
//     window.youtube_prof.rank = {};
//   }
  
//   var r = window.youtube_prof.rank;

//   r.playtime = function() {
    
//   };

// }());