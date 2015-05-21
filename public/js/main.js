(function() {
  var prfMn = document.querySelector('.profile-menu');
  var pstBtn = document.querySelector('.post-menu');
  var mdPst = document.querySelector('.modal');
  var mdCls = document.querySelector('.modal-post .btn-close');

  prfMn.addEventListener('click', function() {
    prfMn.classList.toggle('hidden');
  });

  pstBtn.addEventListener('click', function() {
    mdPst.classList.toggle('hidden');
  });

  mdCls.addEventListener('click', function() {
    mdPst.classList.toggle('hidden');
  });

})();