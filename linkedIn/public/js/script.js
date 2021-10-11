let url = "api.php";
let post_template = document.querySelector('.post.template');
let content = document.querySelector('.content');

request.get(url, function (response) {
    for (let post of response.posts) {
        let post_element = post_template.cloneNode(true);
        post_element.classList.remove('template');
        content.append(post_element);
        let passed_time = Date.now()/1000 - post.created_at;
        const sec_in_day = 60 * 60 * 24;
        const days_passed = Math.floor(passed_time / sec_in_day) + "d";

        post_element.querySelector('.post__author-name').textContent = post.author;
        post_element.querySelector('.post__image').setAttribute('src', post.image_path);
        post_element.querySelector('.fallower_nr').textContent = post.fallowers;

        post_element.querySelector('.post__content').innerHTML = post.content;
        post_element.querySelector('.likes_count').textContent = post.likes;
        post_element.querySelector('.comments_count').textContent = post.comment_count;
        post_element.querySelector('.post__created').textContent = days_passed;
    }
});
