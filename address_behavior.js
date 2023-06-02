const citySelect = document.getElementById("city");
const districtSelect = document.getElementById("district");

const options = {
  "Manila City": [
    "Binondo",
    "Ermita",
    "Intramuros",
    "Malate",
    "Paco",
    "Pandacan",
    "Port Area",
    "Quiapo",
    "Sampaloc",
    "San Andres",
    "San Miguel",
    "San Nicolas",
    "Santa Ana",
    "Santa Cruz",
    "Santa Mesa",
    "Tondo",
  ],
  "Caloocan City": [
    "Bagong Barrio",
    "Bagumbong",
    "Caloocan North",
    "Deparo",
    "Kaunlaran Village",
    "Maypajo",
    "San Jose",
    "Sangandaan",
    "Tala",
    "Unang Sigaw",
  ],
  "Las Piñas City": [
    "Almanza",
    "B.F. International",
    "C.A.A. - B.F. International",
    "Daniel Fajardo",
    "Elias Aldana",
    "Ilaya",
    "Manuyo",
    "Pamplona",
    "Pilar",
    "Pulang Lupa",
    "Talon",
  ],
  "Makati City": [
    "Bangkal",
    "Bel-Air",
    "Carmona",
    "Cembo",
    "Comembo",
    "Dasmarinas Village",
    "East Rembo",
    "Forbes Park",
    "Guadalupe Nuevo",
    "Guadalupe Viejo",
    "Kasilawan",
    "La Paz",
    "Magallanes",
    "Olympia",
    "Palanan",
    "Pembo",
    "Pinagkaisahan",
    "Pio del Pilar",
    "Pitogo",
    "Poblacion",
    "Post Proper Northside",
    "Post Proper Southside",
    "Rizal",
    "San Antonio",
    "San Isidro",
    "San Lorenzo",
    "Santa Cruz",
    "Singkamas",
    "South Cembo",
    "Tejeros",
    "Urdaneta",
    "Valenzuela",
    "West Rembo",
  ],
  Malabon: [
    "Acacia",
    "Baritan",
    "Bayan-bayanan",
    "Catmon",
    "Concepcion",
    "Dagat-dagatan",
    "Dampalit",
    "Flores",
    "Hulong Duhat",
    "Ibaba",
    "Longos",
    "Maysilo",
    "Muzon",
    "Niugan",
    "Panghulo",
    "Potrero",
    "San Agustin",
    "Santolan",
    "Tañong",
    "Tinajeros",
    "Tonsuya",
    "Tugatog",
  ],
  Mandaluyong: [
    "Addition Hills",
    "Bagong Silang",
    "Barangka Drive",
    "Barangka Ibaba",
    "Barangka Ilaya",
    "Barangka Itaas",
    "Buayang Bato",
    "Burol",
    "Daang Bakal",
    "Hagdang Bato Itaas",
    "Hagdang Bato Libis",
    "Harapin Ang Bukas",
    "Highway Hills",
    "Hulo",
    "Mabini-J. Rizal",
    "Malamig",
    "Mauway",
    "Namayan",
    "New Zañiga",
    "Old Zañiga",
    "Pag-asa",
    "Plainview",
    "Pleasant Hills",
    "Poblacion",
    "San Jose",
    "Vergara",
    "Wack-Wack Greenhills",
  ],
  Marikina: [
    "Barangka",
    "Calumpang",
    "Concepcion Dos",
    "Concepcion Uno",
    "Fortune",
    "Industrial Valley",
    "Jesus Dela Peña",
    "Malanday",
    "Malanday",
    "Marikina Heights",
    "Nangka",
    "Parang",
    "San Roque",
    "Santa Elena",
    "Santo Niño",
    "Tañong",
  ],
  "Muntinlupa City": [
    "Alabang",
    "Ayala Alabang",
    "Bayanan",
    "Buli",
    "Cupang",
    "Poblacion",
    "Putatan",
    "Sucat",
  ],
  "Navotas City": [
    "Bagumbayan North",
    "Bagumbayan South",
    "Bangculasi",
    "Daanghari",
    "Navotas East",
    "Navotas West",
    "North Bay Boulevard North",
    "North Bay Boulevard South",
    "San Jose",
    "San Rafael Village",
    "Sipac-Almacen",
    "Tangos",
    "Tanza",
  ],
  "Parañaque City": [
    "Baclaran",
    "Don Bosco",
    "Don Galo",
    "La Huerta",
    "Marina",
    "San Dionisio",
    "San Isidro",
    "San Martin de Porres",
    "Santo Niño",
    "Tambo",
    "Vitalez",
  ],
  Pasay: [
    "Barangay 1",
    "Barangay 2",
    "Barangay 3",
    "Barangay 4",
    "Barangay 5",
    "Barangay 6",
    "Barangay 7",
    "Barangay 8",
    "Barangay 9",
    "Barangay 10",
    "Barangay 11",
    "Barangay 12",
    "Barangay 13",
    "Barangay 14",
    "Barangay 15",
    "Barangay 16",
    "Barangay 17",
    "Barangay 18",
    "Barangay 19",
    "Barangay 20",
  ],
  Pasig: [
    "Bagong Ilog",
    "Bagong Katipunan",
    "Bambang",
    "Buting",
    "Caniogan",
    "Del Monte",
    "Kalawaan",
    "Kapasigan",
    "Kapitolyo",
    "Malinao",
    "Manggahan",
    "Maybunga",
    "Oranbo",
    "Palatiw",
    "Pinagbuhatan",
    "Pineda",
    "Rosario",
    "San Antonio",
    "San Joaquin",
    "San Jose",
    "San Miguel",
    "San Nicolas",
    "San Pedro",
    "Santa Cruz",
    "Santa Lucia",
    "Santa Rosa",
    "Santolan",
    "Sumilang",
    "Ugong",
    "Ugong Norte",
  ],
  Pateros: ["Aguho", "Magtanggol", "Martires Del 96", "Poblacion"],
  "Quezon City": [
    "Alicia",
    "Amihan",
    "Apolonio Samson",
    "Bagbag",
    "Bagong Bayan",
    "Bagong Lipunan ng Crame",
    "Bagong Pag-asa",
    "Bagong Silangan",
    "Bagumbuhay",
    "Bahay Toro",
    "Balingasa",
    "Balong Bato",
    "Batasan Hills",
    "Bayanihan",
    "Blue Ridge A",
    "Blue Ridge B",
    "Botocan",
    "Bungad",
    "Camp Aguinaldo",
    "Capitol Hills",
    "Central",
    "Claro",
    "Commonwealth",
    "Culiat",
    "Damar",
    "Damayang Lagi",
    "Damarinas",
    "Diliman",
    "Don Manuel",
    "Doña Aurora",
    "Doña Faustina",
    "Doña Imelda",
    "Doña Josefa",
    "Doña Petra",
    "Doña Victorina",
    "E. Rodriguez",
    "East Kamias",
    "Escopa",
    "Fairview",
    "Filinvest Homes",
    "Galas",
    "Horseshoe",
    "Immaculate Concepcion",
    "Jordan Plains",
    "Kabayanan",
    "Kaligayahan",
    "Kalusugan",
    "Kalusugan",
    "Kamuning",
    "Kapitapitan",
    "Karuhatan",
    "Kaunlaran",
    "Katipunan",
    "Kaunlaran Village",
    "Krus na Ligas",
    "Laging Handa",
    "Libis",
    "Lourdes",
    "Loyola Heights",
    "Maharlika",
    "Mangga",
    "Mariana",
    "Mariblo",
    "Mariana-Ususan",
    "Masambong",
    "Matandang Balara",
    "Matalahib",
    "Matandang Balara",
    "Milagrosa",
    "Milagrosa- Kamuning",
    "Nagkaisang Nayon",
    "N.S. Amoranto",
    "N.S. Amoranto-Sauyo",
    "Nayong Kanluran",
    "New Era",
    "North Fairview",
    "Novaliches Proper",
    "Obrero",
    "Old Capitol Site",
    "Paang Bundok",
    "Pag-ibig sa Nayon",
    "Paligsahan",
    "Paltok",
    "Pansol",
    "Pasong Putik",
    "Pasong Tamo",
    "Payatas",
    "Phil-Am",
    "Philand",
    "Piñahan",
    "Project 4",
    "Project 6",
    "Project 7",
    "Project 8",
    "Project Area",
    "Quirino 2-A",
    "Quirino 2-B",
    "Quirino 3-A",
    "Quirino 3-B",
    "Quirino 4-A",
    "Quirino 4-B",
    "Ramon Magsaysay",
    "Riverside",
    "Roxas",
    "Sacred Heart",
    "Salvacion",
    "San Agustin",
    "San Antonio",
    "San Bartolome",
    "San Isidro",
    "San Isidro Labrador",
    "San Jose",
    "San Martin de Porres",
    "San Roque",
    "San Vicente",
    "Santa Cruz",
    "Santa Lucia",
    "Santa Mesa Heights",
    "Santa Teresita",
    "Santo Cristo",
    "Santo Niño",
    "Santo Tomas",
    "Santol",
    "Sauyo",
    "Siena",
    "Sikatuna Village",
    "Silangan",
    "Silanganan",
    "Socorro",
    "South Triangle",
    "St. Ignatius",
    "Sta. Cruz",
    "Sta. Lucia",
    "Sta. Monica",
    "Sta. Teresita",
    "Santo Domingo",
    "Tagumpay",
    "Talayan",
    "Talipapa",
    "Tandang Sora",
    "Tatalon",
    "Tatalon Estate",
    "Teodoro",
    "Tibagan",
    "Tumana",
    "Twinville",
    "U.P. Campus",
    "U.P. Village",
    "Unang Sigaw",
    "Unang Sigaw-Paligsahan",
    "Valencia",
    "Vasra",
    "Villa Maria Clara",
    "Villa Maria Luisa",
    "Villa Maria Clara",
    "Villa Rosa",
    "Villanueva",
    "West Kamias",
    "West Triangle",
    "White Plains",
    "Zambal",
  ],
  "San Juan City": [
    "Addition Hills",
    "Balong Bato",
    "Batis",
    "Corazon De Jesus",
    "Ermitaño",
    "Greenhills",
    "Halo-Halo",
    "Isabelita",
    "Kabayanan",
    "Little Baguio",
    "Maytunas",
    "Onse",
    "Pasadeña",
    "Pedro Cruz",
    "Progreso",
    "Rivera",
    "Salapan",
    "San Perfecto",
    "St. Joseph",
    "Tibagan",
    "West Crame",
  ],
  "Taguig City": [
    "Bagumbayan",
    "Bambang",
    "Calzada",
    "Central Bicutan",
    "Central Signal Village",
    "Fort Bonifacio",
    "Katuparan",
    "Ligid-Tipas",
    "Lower Bicutan",
    "Maharlika Village",
    "North Signal Village",
    "Palingon",
    "Pinagsama",
    "San Miguel",
    "Santa Ana",
    "South Signal Village",
    "Tuktukan",
    "Upper Bicutan",
    "Ususan",
    "Wawa",
  ],
  "Valenzuela City": [
    "Arkong Bato",
    "Bagbaguin",
    "Balangkas",
    "Bignay",
    "Canumay",
    "Coloong",
    "Dalandanan",
    "Gen. T. de Leon",
    "Isla",
    "Karuhatan",
    "Lingunan",
    "Mabolo",
    "Malanday",
    "Malanday",
    "Mapulang Lupa",
    "Marulas",
    "Maysan",
    "Parada",
    "Pariancillo Villa",
    "Paso de Blas",
    "Pasolo",
    "Poblacion",
    "Polo",
    "Punturin",
    "Rincon",
    "Tagalag",
    "Veinte Reales",
    "Wawang Pulo",
  ],
};

// Populate city options
for (const city in options) {
  const option = document.createElement("option");
  option.value = city;
  option.text = city;
  citySelect.appendChild(option);
}

// Populate district options based on selected city
citySelect.addEventListener("change", function () {
  const selectedCity = this.value;
  const districts = options[selectedCity];

  // Clear previous options
  districtSelect.innerHTML = "";

  // Populate district options
  districts.forEach((district) => {
    const option = document.createElement("option");
    option.value = district;
    option.text = district;
    districtSelect.appendChild(option);
  });
});
