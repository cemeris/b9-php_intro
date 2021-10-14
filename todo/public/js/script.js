let todo_list = document.querySelector('.todo-list');

request.get('api.php?api-name=get-all', function (response) {
    for (const [id, row] of Object.entries(response.entities)) {
        addToDoElement(id, row.description);
    }
});

let todo_form = document.getElementById('todo_form');

todo_form.onsubmit = function (event) {
    event.preventDefault();
    request.post(this, function (response) {
        document.getElementById('todo-description').value = '';
        addToDoElement(response.entity.id, response.entity.description);
    });
};

function addToDoElement(id, description) {
    let li = document.querySelector('.template.todo').cloneNode(true);
    li.classList.remove('template');
    li.querySelector('.text').textContent = description;
    li.setAttribute('data-id', id);
    todo_list.append(li);
}

todo_list.onclick = function (event) {
    let element = event.target;
    if(element.classList.contains('todo__delete')) {
        event.preventDefault();

        let url = element.getAttribute('href');
        let task_element = element.parentNode.parentNode;
        let id = task_element.getAttribute('data-id');
        url += "&id=" + id;

        request.get(url, function (response) {
            task_element.remove();
        });

    }
}