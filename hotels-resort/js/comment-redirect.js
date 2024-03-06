document.addEventListener('DOMContentLoaded', function() {
  const allReplyAnchor = document.querySelectorAll('.comment-reply-link');

  allReplyAnchor.forEach(function(replyAnchor) {
    replyAnchor.addEventListener('click', function(e) {
      const url = e.target.getAttribute('href');
      window.location.href = url;
    });
  })
});