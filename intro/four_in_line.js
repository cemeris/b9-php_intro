'use strict';

let game_board = document.querySelector('.game_board');
let message_element = document.querySelector('.message');
let base_url = "four_in_line_request.php";

request.get(base_url, refreshGame);

game_board.onclick = function (event) {
    event.preventDefault();
    let btn = event.target;
    let url = base_url + btn.getAttribute('href');

    request.get(url, refreshGame);
};

document.querySelector('.reset').onclick = function (event) {
    event.preventDefault();
    let url = base_url + this.getAttribute('href');

    request.get(url, refreshGame);
};

function refreshGame(response) {
    game_board.innerHTML = response.buttons;
    if (response.hasOwnProperty('message')) {
        message_element.innerHTML = response.message;
    }
    else {
        message_element.innerHTML = '';
    }
}
