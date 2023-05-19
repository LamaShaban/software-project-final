let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

let count = 0;
let totalPrice = 0;


openShopping.addEventListener('click', () => {
    body.classList.add('active-card');
})
closeShopping.addEventListener('click', () => {
    body.classList.remove('active-card');
})


let product = [
    {
        id: 1,
        name: "2 Watt Resistor",
        image: "2 watt res..png",
        price: 30
    },
    {
        id: 2,
        name: "1 Watt Resistor",
        image: "1 watt.png",
        price: 30
    },
    {
        id: 3,
        name: "3 Watt Resistor",
        image: '3 watt resistor.png',
        price: 30
    },
    {
        id: 4,
        name: 'fr107',
        image: 'fr107.png',
        price: 10
    },
    {
        id: 5,
        name: 'in5822',
        image: 'in5822.png',
        price: 5
    },
    {
        id: 6,
        name: 'in4007',
        image: 'in4007.png',
        price: 12
    },
    {
        id: 7,
        name: "fr207",
        image: "fr207.png",
        price: 7
    },
    {
        id: 8,
        name: "0.125 Watt Resistor",
        image: "0.125 watt.png",
        price: 5
    },
    {
        id: 9,
        name: "0.25 Watt Resistor",
        image: '0.25watt.png',
        price: 10
    },
    {
        id: 10,
        name: 'in5399',
        image: 'in5399.png',
        price: 11
    },
    {
        id: 11,
        name: 'in4148',
        image: 'in4148.png',
        price: 5
    },
    {
        id: 12,
        name: '0.5 Watt Resistor',
        image: '0.5watt.png',
        price: 12
    },
    {
        id: 13,
        name: "in5408",
        image: 'in5408.png',
        price: 10
    },
    {
        id: 14,
        name: 'n-channel',
        image: 'n channel fet.png',
        price: 15
    },
    {
        id: 15,
        name: 'in5819',
        image: 'in5819.png',
        price: 13
    },
    {
        id: 16,
        name: 'n channel-jeft',
        image: 'n channel jfet.jpg',
        price: 12
    },
    {
        id: 17,
        name: 'p-channel jfet',
        image: 'p channel jfet.png',
        price: 12
    },
    {
        id: 18,
        name: "npn transistor",
        image: 'npn.jfif',
        price: 10
    },
    {
        id: 19,
        name: 'pnp transistor',
        image: 'pnp.n.png',
        price: 15
    },
    {
        id: 20,
        name: 'p-channel',
        image: 'p-channel fet.jpg',
        price: 13
    },
    {
        id: 21,
        name: '(DACs)',
        image: 'Digital-to-Analog Converters (DACs) and Analog-to-Digital Converters (ADCs).jpg',
        price: 13
    },
    {
        id: 22,
        name: 'Magnetic Buzzer',
        image: 'Magnetic Buzzer.jpg',
        price: 12
    },
    {
        id: 23,
        name: '(MCUs)',
        image: 'Microcontrollers (MCUs).jpg',
        price: 15
    },
    {
        id: 24,
        name: 'Mechanical Buzzer',
        image: 'Mechanical Buzzer.jpg',
        price: 13
    },
    {
        id: 25,
        name: '(Op-Amps)',
        image: 'p-channel fet.jpg',
        price: 16
    },
    {
        id: 26,
        name: 'Piezoelectric Buzzer',
        image: 'Piezoelectric Buzzer.jpg',
        price: 13
    },
    {
        id: 27,
        name: 'Voltage Regulators',
        image: 'Operational Amplifiers (Op-Amps).png',
        price: 13
    },
    {
        id: 28,
        name: 'Electromechanical Buzzer',
        image: 'Elect_buzzer.png',
        price: 14
    },
];
let listCards = [];

function addToCard(key) {
    if (listCards[key] == null) {
        listCards[key] = product[key];
        listCards[key].quantity = 1;
        quantity.innerText = count;
    }
    reloadCard();
}
function reloadCard() {
    listCard.innerHTML = '';
    listCards.forEach((value, key) => {
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;
        if (value != null) {
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="images/${value.image}"/></div>
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>`;
            listCard.appendChild(newDiv);
        }
    })
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;

}
function changeQuantity(key, quantity) {
    console.log(key, quantity);
    if (quantity == 0) {
        delete listCards[key];
    } else {
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * product[key].price;
    }
    reloadCard();

}