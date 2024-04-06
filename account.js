function showPublicPosts() {
    var publicPosts = document.querySelectorAll('.public-post');
    var privatePosts = document.querySelectorAll('.private-post');

    publicPosts.forEach(function(post) {
        post.style.display = 'inline-block';
    });

    privatePosts.forEach(function(post) {
        post.style.display = 'none'; 
    });

    document.getElementById('viewPublic').classList.add('selected-link');
    document.getElementById('viewPrivate').classList.remove('selected-link');
}

function showPrivatePosts() {
    var publicPosts = document.querySelectorAll('.public-post');
    var privatePosts = document.querySelectorAll('.private-post');

    publicPosts.forEach(function(post) {
        post.style.display = 'none'; 
    });

    privatePosts.forEach(function(post) {
        post.style.display = 'inline-block';
    });

    document.getElementById('viewPrivate').classList.add('selected-link');
    document.getElementById('viewPublic').classList.remove('selected-link');
}

window.onload = function() {
    showPublicPosts(); 
};
