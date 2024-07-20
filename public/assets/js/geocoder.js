const map = L.map('map').setView([51.505, -0.09], 13);
const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

let currentMarker;
/**
 *
 * @param
 * Fungsi untuk menampilkan marker ketika sebuah lokasi dipilih pada map
 * Dimana kita akan mendapatkan nilai latitude dan longitude dari lokasi tersebut
 *
 */
function onMapClick(e) {
    if (!currentMarker) {
        currentMarker = L.marker(e.latlng,{
            draggable:true
        }).addTo(map);
        console.log("Koordinat awal",e.latlng);
        currentMarker.on('dragend',onMarkerDragend);
    } else {
        currentMarker.setLatLng(e.latlng);
        console.log("Koordinat baru",e.latlng);
    }
}

/**
 * Kemudian jika marker di drag kita juga akan mendatkan nilai latitude dan longitude dari
 * lokasi yang dipilih
 *
 */
function onMarkerDragend(e) {
    const latlng = e.target.getLatLng()
    console.log("koordinat marker onDrag",latlng);
}

map.on('click',onMapClick);
