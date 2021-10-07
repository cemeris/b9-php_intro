let game_board = document.querySelector('.game_board');
let base_url = "four_in_line_request.php";


game_board.onclick = function (event) {
    event.preventDefault();
    let btn = event.target;
    let url = base_url + btn.getAttribute('href');

    request.get(url, function (response) {
        game_board.innerHTML = response.buttons;
    });
};

request.get(base_url, function (response) {
    game_board.innerHTML = response.buttons;
});
