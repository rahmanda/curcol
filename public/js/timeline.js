(function() {
  var twtbx = document.querySelector('.input-tweet textarea');
  var twtbxMdl = document.querySelector('.modal-post .input-tweet textarea');
  var cntlbl = document.getElementsByClassName('word-count')[0];
  var cntlblMdl = document.querySelector('.modal-post .word-count');
  var mxlgt = 140;

  twtbx.onkeyup = function() {
    var rmnchr = mxlgt - twtbx.value.length;
    if (rmnchr < 0) {
      rmnchr = 0;
    }
    cntlbl.innerText = rmnchr;
  };

  twtbxMdl.onkeyup = function() {
    var rmnchr = mxlgt - twtbxMdl.value.length;
    if (rmnchr < 0) {
      rmnchr = 0;
    }
    cntlblMdl.innerText = rmnchr;
  };

})();