let todo_list = document.querySelector('.todo-list');

request.get('api.php?api-name=get-all', function (response) {
    for (const [key, row] of Object.entries(response.entities)) {
        todo_list.append(row.description);
    }

    
});