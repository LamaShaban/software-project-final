let products = {
  data: [
    {
      productName: "Microcontrollers (MCUs)",
      category: "ICs",
      price: "15",
      image: "images/Microcontrollers (MCUs).jpg",
      path: "MCUS.php",
    },
    {
      productName: "Magnetic Buzzer",
      category: "Buzzers",
      price: "12",
      image: "images/Magnetic Buzzer.jpg",
      path: "Magnetic Buzzers.php",
    },
    {
      productName: "Mechanical Buzzer",
      category: "Buzzers",
      price: "13",
      image: "images/Mechanical Buzzer.jpg",
      path: "Mechanical Buzzers.php",
    },
    {
      productName: "2 Watt Resistor",
      category: "Resistores",
      price: "30",
      image: "images/2 watt res..png",
      path: "2watt.php",
    },
    {
      productName: "1 Watt Resistor",
      category: "Resistores",
      price: "30",
      image: "images/1 watt.png",
      path: "1watt.php",
    },
    
    {
      productName: "3 Watt Resistor",
      category: "Resistores",
      price: "30",
      image: "images/3 watt resistor.png",
      path: "3watt.php",
    },
    {
      productName: "in5822",
      category: "Diodes",
      price: "40",
      image: "images/in5822.png",
      path: "in5822.php",
    },
    {
      productName: "fr107",
      category: "Diodes",
      price: "40",
      image: "images/fr107.png",
      path: "fr107.php",
    },
    {
      productName: "fr207",
      category: "Diodes",
      price: "40",
      image: "images/fr207.png",
      path: "fr207.php",
    },
    {
      productName: "in4007",
      category: "Diodes",
      price: "40",
      image: "images/in4007.png",
      path: "in4007.php",
    },
    {
      productName: "0.25 Watt Resistor",
      category: "Resistores",
      price: "30",
      image: "images/0.25watt.png",
      path: "0.25watt.php",
    },
    {
      productName: "0.125 Watt Resistor",
      category: "Resistores",
      price: "30",
      image: "images/0.125 watt.png",
      path: "0.125watt.php",
    },
    {
      productName: "in4148",
      category: "Diodes",
      price: "40",
      image: "images/in4148.png",
      path: "in4148.php",
    },
    {
      productName: "in5399",
      category: "Diodes",
      price: "40",
      image: "images/in5399.png",
      path: "in5399.php",
    },
    {
      productName: "in5408",
      category: "Diodes",
      price: "40",
      image: "images/in5408.png",
      path: "in5408.php",
    },
    {
      productName: "0.5 Watt Resistor",
      category: "Resistores",
      price: "30",
      image: "images/0.5watt.png",
      path: "0.5watt.php",
    },
    {
      productName: "in5819",
      category: "Diodes",
      price: "40",
      image: "images/in5819.png",
      path: "in5819.php",
    },
    
    {
      productName: "n-channel",
      category: "Transistors",
      price: "40",
      image: "images/n channel fet.png",
      path: "n-channel.php",
    },
    {
      productName: "npn transistor",
      category: "Transistors",
      price: "4",
      image: "images/npn.jfif",
      path: "npn trans.php",
    },
    {
      productName: "p-channel jfet",
      category: "Transistors",
      price: "4",
      image: "images/p channel jfet.png",
      path: "p-channel jfet.php",
    },
    {
      productName: "n channel-jeft",
      category: "Transistors",
      price: "5",
      image: "images/n channel jfet.jpg",
      path: "n-channel-jfet.php",
    },
    {
      productName: "p-channel",
      category: "Transistors",
      price: "40",
      image: "images/p-channel fet.jpg",
      path: "p-channel.php",
    },
    {
      productName: "pnp transistor",
      category: "Transistors",
      price: "40",
      image: "images/pnp.n.png",
      path: "pnptrans.php",
    },
    {
      productName: "Digital-to-Analog Converters (DACs)",
      category: "ICs",
      price: "13",
      image: "images/Digital-to-Analog Converters (DACs) and Analog-to-Digital Converters (ADCs).jpg",
      path: "DACs.php",
    },
    {
      productName: "Electromechanical Buzzer",
      category: "Buzzers",
      price: "14",
      image: "images/Elect_buzzer.png",
      path: "Electromechanical Buzzers.php",
    },
    {
      productName: "Voltage Regulators",
      category: "ICs",
      price: "13",
      image: "images/Voltage Regulators.jpg",
      path: "Voltage Regulators.php",
    },
    {
      productName: "Piezoelectric Buzzer",
      category: "Buzzers",
      price: "13",
      image: "images/Piezoelectric Buzzer.jpg",
      path: "Piezoelectric Buzzers.php",
    },
    {
      productName: "Operational Amplifiers (Op-Amps)",
      category: "ICs",
      price: "16",
      image: "images/Operational Amplifiers (Op-Amps).png",
      path: "op_amps.php",
    },
  ],
};

for (let i of products.data) {
  //Create Card
  let card = document.createElement("div");
  //Card should have category and should stay hidden initially
  card.classList.add("card", i.category, "hide");
  //image div
  let imgContainer = document.createElement("div");
  imgContainer.classList.add("image-container");
  //img tag
  let image = document.createElement("img");
  image.setAttribute("src", i.image);
  imgContainer.appendChild(image);
  card.appendChild(imgContainer);
  //container
  let contain = document.createElement("div");
  contain.classList.add("contain");
  //product name
  let name = document.createElement("a");
  name.classList.add("product-name");
  name.setAttribute("href", i.path);
  name.innerText = i.productName.toUpperCase();
  contain.appendChild(name);
  //price
  let price = document.createElement("h6");
  price.innerText = "Price: $" + i.price;
  contain.appendChild(price);


  let Detail = document.createElement("a");
  Detail.classList.add("add-to-cart");
  Detail.innerText = "Show more Details";
  Detail.setAttribute("href", i.path);
  contain.appendChild(Detail);

  card.appendChild(contain);
  document.getElementById("products").appendChild(card);
}

//parameter passed from button (Parameter same as category)
function filterProduct(value) {
  //Button class code
  let buttons = document.querySelectorAll(".button-value");
  buttons.forEach((button) => {
    //check if value equals innerText
    if (value.toUpperCase() == button.innerText.toUpperCase()) {
      button.classList.add("active");
    } else {
      button.classList.remove("active");
    }
  });

  //select all cards
  let elements = document.querySelectorAll(".card");
  //loop through all cards
  elements.forEach((element) => {
    //display all cards on 'all' button click
    if (value == "all") {
      element.classList.remove("hide");
    } else {
      //Check if element contains category class
      if (element.classList.contains(value)) {
        //display element based on category
        element.classList.remove("hide");
      } else {
        //hide other elements
        element.classList.add("hide");
      }
    }
  });
}

//Search button click
document.getElementById("search").addEventListener("click", () => {
  //initializations
  let searchInput = document.getElementById("search-input").value;
  let elements = document.querySelectorAll(".product-name");
  let cards = document.querySelectorAll(".card");

  //loop through all elements
  elements.forEach((element, index) => {
    //check if text includes the search value
    if (element.innerText.includes(searchInput.toUpperCase())) {
      //display matching card
      cards[index].classList.remove("hide");
    } else {
      //hide others
      cards[index].classList.add("hide");
    }
  });
});

//Initially display all products
window.onload = () => {
  filterProduct("all");
};

