// Deklarasi kartu dalam array beserta valuenya
const blackJackCards = [
    { name: "10-C", src: "cards/10-C.png", value: 10 },
    { name: "10-D", src: "cards/10-D.png", value: 10 },
    { name: "10-H", src: "cards/10-H.png", value: 10 },
    { name: "10-S", src: "cards/10-S.png", value: 10 },
    { name: "2-C", src: "cards/2-C.png", value: 2 },
    { name: "2-D", src: "cards/2-D.png", value: 2 },
    { name: "2-H", src: "cards/2-H.png", value: 2 },
    { name: "2-S", src: "cards/2-S.png", value: 2 },
    { name: "3-C", src: "cards/3-C.png", value: 3 },
    { name: "3-D", src: "cards/3-D.png", value: 3 },
    { name: "3-H", src: "cards/3-H.png", value: 3 },
    { name: "3-S", src: "cards/3-S.png", value: 3 },
    { name: "4-C", src: "cards/4-C.png", value: 4 },
    { name: "4-D", src: "cards/4-D.png", value: 4 },
    { name: "4-H", src: "cards/4-H.png", value: 4 },
    { name: "4-S", src: "cards/4-S.png", value: 4 },
    { name: "5-C", src: "cards/5-C.png", value: 5 },
    { name: "5-D", src: "cards/5-D.png", value: 5 },
    { name: "5-H", src: "cards/5-H.png", value: 5 },
    { name: "5-S", src: "cards/5-S.png", value: 5 },
    { name: "6-C", src: "cards/6-C.png", value: 6 },
    { name: "6-D", src: "cards/6-D.png", value: 6 },
    { name: "6-H", src: "cards/6-H.png", value: 6 },
    { name: "6-S", src: "cards/6-S.png", value: 6 },
    { name: "7-C", src: "cards/7-C.png", value: 7 },
    { name: "7-D", src: "cards/7-D.png", value: 7 },
    { name: "7-H", src: "cards/7-H.png", value: 7 },
    { name: "7-S", src: "cards/7-S.png", value: 7 },
    { name: "8-C", src: "cards/8-C.png", value: 8 },
    { name: "8-D", src: "cards/8-D.png", value: 8 },
    { name: "8-H", src: "cards/8-H.png", value: 8 },
    { name: "8-S", src: "cards/8-S.png", value: 8 },
    { name: "9-C", src: "cards/9-C.png", value: 9 },
    { name: "9-D", src: "cards/9-D.png", value: 9 },
    { name: "9-H", src: "cards/9-H.png", value: 9 },
    { name: "9-S", src: "cards/9-S.png", value: 9 },
    { name: "A-C", src: "cards/A-C.png", value: 11 },
    { name: "A-D", src: "cards/A-D.png", value: 11 },
    { name: "A-H", src: "cards/A-H.png", value: 11 },
    { name: "A-S", src: "cards/A-S.png", value: 11 },
    { name: "J-C", src: "cards/J-C.png", value: 10 },
    { name: "J-D", src: "cards/J-D.png", value: 10 },
    { name: "J-H", src: "cards/J-H.png", value: 10 },
    { name: "J-S", src: "cards/J-S.png", value: 10 },
    { name: "K-C", src: "cards/K-C.png", value: 10 },
    { name: "K-D", src: "cards/K-D.png", value: 10 },
    { name: "K-H", src: "cards/K-H.png", value: 10 },
    { name: "K-S", src: "cards/K-S.png", value: 10 },
    { name: "Q-C", src: "cards/Q-C.png", value: 10 },
    { name: "Q-D", src: "cards/Q-D.png", value: 10 },
    { name: "Q-H", src: "cards/Q-H.png", value: 10 },
    { name: "Q-S", src: "cards/Q-S.png", value: 10 }
];

// Deklarasi & Inisialisasi
let playerMoney = 0;
let playerDeck = [];
let playerSum = 0;
let betAmount = 0;
let botDeck = [];
let botSum = 0;
let deck = [];
let playerAceCount = 0;
let botAceCount = 0;

// Mendapatkan referensi ke elemen DOM (Document Object Model)pada HTML dengan id tertentu
const inputDeposito = document.getElementById("inputDeposito");
const modalStart = new bootstrap.Modal(document.getElementById("modalStart"));
const buttonStart = document.getElementById("buttonStart");

const buttonHit = document.getElementById("buttonHit");
const buttonHold = document.getElementById("buttonHold");
const buttonBet = document.getElementsByClassName("buttonBet");

const textPlayerBet = document.getElementById("textPlayerBet");
const textPlayerSums = document.getElementById("textPlayerSums");
const textPlayerMoney = document.getElementById("textPlayerMoney");

const botDeckContainer = document.getElementById("botDeckContainer");
const playerDeckContainer = document.getElementById("playerDeckContainer");
const textBotSums = document.getElementById("textBotSums");

// sound 
const audioBet = new Audio('./sound/bet.mp3');
const audiocard = new Audio('./sound/card.mp3');
const audiowin = new Audio('./sound/win.mp3');
const audiolose = new Audio('./sound/lose.mp3');
const audioclick = new Audio('./sound/click.mp3');

modalStart.show();
const restartGame = (audio) => {
    if (audio) {
        audioclick.play();
    }
    modalStart.show();
}

const startGame = () => {
    audioclick.play();
    playerMoney = inputDeposito.value;
    modalStart.hide();
    startTurn();
}

const startTurn = () => {
    deck = shuffle(blackJackCards.slice());

    playerDeck = [];
    playerSum = 0;
    playerAceCount = 0;
    betAmount = 0;
    botDeck = [];
    botSum = 0;
    botAceCount = 0;

    playerDeckContainer.innerHTML = "";
    botDeckContainer.innerHTML = "";
    textPlayerSums.textContent = playerSum;
    textPlayerSums.classList.remove('text-danger');
    textBotSums.textContent = botSum;
    textBotSums.classList.remove('text-danger');
    console.log("BeforeAddDeck "+playerSum);
    
    addPlayerDeck(getCard());
    addPlayerDeck(getCard());
    addBotDeck(getCard());
    setPlayerMoney(playerMoney);
    setPlayerBet(betAmount);
    disableHitHold(true);
    disableBetButton(false);

    // Kondisi Blackjack
    if (playerSum === 21) {
        displayModal("modalBlackJack");
        disableHitHold(true);
        disableBetButton(false);
    }
}

// Disable buttons
const disableHitHold = (disable) => {
    buttonHit.disabled = disable;
    buttonHold.disabled = disable;
}
const disableBetButton = (disable) => {
    const buttonsArray = Array.from(buttonBet);
    buttonsArray.forEach(button => {
        button.disabled = disable;
    });
}

// Fungsi kartu random
const shuffle = (cards) => {
    for (let i = 0; i < cards.length; i++) {
        const j = Math.floor(Math.random() * (i + 1));
        [cards[i], cards[j]] = [cards[j], cards[i]];
    }
    return cards;
}

const getCard = () => {
    audiocard.play();
    return deck.pop();
}

// Fungsi player mengambil kartu 
const hit = () => {
    disableBetButton(true);
    addPlayerDeck(getCard());
    if (playerSum > 21) {
        audiolose.play();
        if (playerMoney <= 0) {
            displayModal('modalGameOver');
        } else {
            displayModal('modalKalah');
        }
        disableHitHold(true);
    }
}

// Fungsi bot mengambil kartu
const delay = (ms) => new Promise(resolve => setTimeout(resolve, ms));
const addBotDeckWithDelay = async (card) => {
    addBotDeck(card);
    await delay(500);
    if (botSum < 17) {
        const nextCard = getCard();
        await addBotDeckWithDelay(nextCard);
    } else {
        finalizeHold();
    }
}

const hold = async () => {
    disableBetButton(true);
    const card = getCard();
    await addBotDeckWithDelay(card);
}

// Fungsi aturan permainan
const finalizeHold = () => {
    if (botSum > 21) {
        audiowin.play();
        displayModal('modalMenang');
        setPlayerMoney(playerMoney += (betAmount * 2));
    } else {
        if (playerSum > botSum) {
            audiowin.play();
            displayModal('modalMenang');
            setPlayerMoney(playerMoney += (betAmount * 2));
        } else if (playerSum < botSum) {
            audiolose.play();
            if (playerMoney <= 0) {
                displayModal('modalGameOver');
            } else {
                displayModal('modalKalah');
            }
        } else {
            displayModal('modalSeri');
            setPlayerMoney(playerMoney += betAmount);
        }
    }
    disableHitHold(true);
    disableBetButton(false);
}

// Fungsi pasang taruhan
const placeBet = (amount) => {
    audioBet.play();
    if ((playerMoney -= amount) < 0) {
        playerMoney += amount;
    } else {
        betAmount += amount;
        setPlayerMoney(playerMoney);
        setPlayerBet(betAmount);
        disableHitHold(false);
    }
}

// Fungsi menghapus taruhan
const removeBet = () => {
    playerMoney += betAmount;
    betAmount = 0;
    setPlayerBet(betAmount);
    setPlayerMoney(playerMoney);
}

// Funsi memamggil modal untuk pop up
function displayModal(modalId) {
    const modalElement = document.getElementById(modalId);
    const modal = new bootstrap.Modal(modalElement);
    modal.show();

    modalElement.addEventListener('hidden.bs.modal', function () {
        if (modalId === "modalGameOver") {
            restartGame(false);
        } else if(modalId === "modalBlackJack"){
            console.log("BlackJack");
        } else {
            startTurn();
        }
    }, { once: true });
}

// Fungsi menampilkan kartu player
const addPlayerDeck = (card) => {
    playerDeck.push(card);
    const img = document.createElement('img');
    img.src = card.src;
    img.alt = card.name;
    img.width = 150;
    img.classList.add('mx-1');
    img.classList.add('swipe-down');
    playerDeckContainer.appendChild(img);
    setPlayerSum(card);
}

// Fungsi menampilkan kartu bot
const addBotDeck = (card) => {
    botDeck.push(card);
    const img = document.createElement('img');
    img.src = card.src;
    img.alt = card.name;
    img.width = 150;
    img.classList.add('mx-1');
    img.classList.add('swipe-down');
    botDeckContainer.appendChild(img);
    setBotSum(card);

    // Fungsi kartu bot terbuka/tertutup
    if (botDeck.length <= 1) {
        const backImg = document.createElement('img');
        backImg.src = 'cards/BACK.png';
        backImg.alt = 'Flipped';
        backImg.width = 150;
        backImg.classList.add('mx-1');
        backImg.classList.add('swipe-down');
        botDeckContainer.appendChild(backImg);
    } else {
        const backImg = botDeckContainer.querySelector('img[src="cards/BACK.png"]');
        if (backImg) {
            botDeckContainer.removeChild(backImg);
        }
    }
}

const setPlayerMoney = (text) => {
    textPlayerMoney.textContent = text;
}
const setPlayerBet = (text) => {
    textPlayerBet.textContent = text;
}

// Fungsi menghitung total kartu pemain
const setPlayerSum = (card) => {
    const result = getCardValue(playerSum, card, playerAceCount);
    playerSum = result.newSum;
    playerAceCount = result.aceCount;
    
    textPlayerSums.textContent = playerSum;
    console.log("Player Ace: "+playerAceCount);
    
    const parentDiv = textPlayerSums.closest(".bg-glass");

    if (playerSum > 21) {
        textPlayerSums.classList.add('text-danger');
        parentDiv.classList.add("bg-glass-danger");
    } else {
        textPlayerSums.classList.remove('text-danger');
        parentDiv.classList.remove("bg-glass-danger");
    }
}

// Fungsi menghitung total kartu bot
const setBotSum = (card) => {
    const result = getCardValue(botSum, card, botAceCount);
    botSum = result.newSum;
    botAceCount = result.aceCount;

    textBotSums.textContent = botSum;
    console.log("Bot Ace: "+botAceCount);
    
    const parentDiv = textBotSums.closest(".bg-glass");

    if (botSum > 21) {
        textBotSums.classList.add('text-danger');
        parentDiv.classList.add("bg-glass-danger");
    } else {
        textBotSums.classList.remove('text-danger');
        parentDiv.classList.remove("bg-glass-danger");
    }
}

// Fungsi kartu AS bernilai 1 atau 11
const getCardValue = (currentSum, card, aceCount) => {
    let cardValue = card.value;
    let newSum = currentSum + cardValue;

    if (cardValue === 11) {
        aceCount++;
    }

    while (newSum > 21 && aceCount > 0) {
        newSum -= 10;
        aceCount--;
    }

    return { newSum, aceCount };
};
