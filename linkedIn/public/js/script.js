let url = "api.php";
let post_template = document.querySelector('.post.template');
let content = document.querySelector('.content');

request.get(url, function (response) {
    for (const [property, value] of Object.entries(response.posts)) {
        let post_element = post_template.cloneNode(true);
        post_element.classList.remove('template');
        content.append(post_element);
    }
});