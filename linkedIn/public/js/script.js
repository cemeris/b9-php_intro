let post_template = document.querySelector('.post.template');
let posts_wrapper = document.querySelector('.posts-wrapper');
const sec_in_day = 60 * 60 * 24;
let loaded = 0;


/**
 * @param {*} post {
 *  created_at:,
 *  author:,
 *  image_path:,
 *  fallowers:,
 *  likes:,
 *  content:,
 *  comment_count:,
 * }
 */
function insertPost(post, append = true) {
    let post_element = post_template.cloneNode(true);
    post_element.classList.remove('template');
    if (append) {
        posts_wrapper.append(post_element);
    }
    else {
        posts_wrapper.prepend(post_element);
    }

    let passed_time_in_seconds = Date.now()/1000 - post.created_at;
    let days_passed = Math.floor(passed_time_in_seconds / sec_in_day) + "d";

    post_element.querySelector('.post__author-name').textContent = post.author;

    let image_element = post_element.querySelector('.post__image');
    if (post.image_path) {
        image_element.setAttribute('src', post.image_path);
    }
    else {
        image_element.remove();
    }

    post_element.querySelector('.fallower_nr').textContent = post.fallowers;

    post_element.querySelector('.post__content').innerHTML = post.content;
    post_element.querySelector('.likes_count').textContent = post.likes;
    post_element.querySelector('.comments_count').textContent = post.comment_count;
    post_element.querySelector('.post__created').textContent = days_passed;

    loaded++;
}

function thePost(count, url = "api.php?api-name=rand_post&count=1") {
    if (count == 0) {
        return;
    }
    request.get(url, function (response) {
        if (!response.posts[0]) {
            return;
        }
        
        for (let post of response.posts) {
            insertPost(post);
        }
        thePost(--count);
    });
}

thePost(5, "api.php?api-name=posts");

/*
const posts_to_load = 2;
getPost(posts_to_load);
*/
let shift_state = false;
const post_form =  document.getElementById('new_post_form');

post_form.onsubmit = function (event) {
    event.preventDefault();
};
post_form.onkeydown = newPost;

post_form.onkeyup = function (event) {
    if (event.key == 'Shift') {
        shift_state = false;
    }
};

function newPost (event) {
    if (event.key == 'Shift') {
        shift_state = true;
    }
    else if (
        event.key == 'Enter' &&
        shift_state == false
    ) {
        const form = document.getElementById('new_post_form');
        event.preventDefault();

        request.post(
            form,
            function (response) {
                insertPost({
                    created_at: '',
                    author: '',
                    image_path: '',
                    fallowers: 15,
                    likes: 14,
                    content: response.post.content, 
                    comment_count: '',
                }, false);
            },
            function () {
                form.querySelector('textarea').value = '';
            }
        );
    }
}


const posts_to_load = 2;
window.onscroll = function (event) {
    var element = document.querySelector('.last');
    var window_height = window.innerHeight ||
        document.documentElement.clientHeight ||
        document.body.clientHeight;
    if (element.getBoundingClientRect().top - 10 < window_height) {
        thePost(posts_to_load);
    }
};

/*
document.addEventListener('scroll', function(event)
{
    var element = this.querySelector('.last');
    console.log(element, element.getBoundingClientRect().top);
    if (element.scrollHeight - element.scrollTop === element.clientHeight)
    {
        //alert('scrolled');
    }
});
*/