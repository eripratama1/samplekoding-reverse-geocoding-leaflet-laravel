// Fungsi Create Spot
function createSpot() {
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
            currentMarker = L.marker(e.latlng, {
                draggable: true
            }).addTo(map);
            //console.log("Koordinat awal",e.latlng);
            currentMarker.on('dragend', onMarkerDragend);
        } else {
            currentMarker.setLatLng(e.latlng);
            //console.log("Koordinat baru",e.latlng);
        }

        // Menetapkan nilai untuk elemen dengan id lat dan lng pada HTML (file create.blade.php)
        document.getElementById("lat").value = e.latlng.lat;
        document.getElementById("lng").value = e.latlng.lng;

        // Menggunakan API  untuk proses reverse geocoding dengan latitude dan longitude
        const url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=" + e.latlng.lat + "&lon=" + e.latlng.lng;
        // Memanggil fungsi fetchDataLocation untuk mendapatkan data lokasi berdasarkan latitude dan longitude
        fetchDataLocation(url);
    }

    /**
     * Kemudian jika marker di drag kita juga akan mendatkan nilai latitude dan longitude dari
     * lokasi yang dipilih
     *
     */
    function onMarkerDragend(e) {
        const latlng = e.target.getLatLng()
        //console.log("koordinat marker onDrag",latlng);

        // Menetapkan nilai untuk elemen dengan id lat dan lng pada HTML (file create.blade.php)
        document.getElementById("lat").value = latlng.lat;
        document.getElementById("lng").value = latlng.lng;

        // Menggunakan API  untuk proses reverse geocoding dengan latitude dan longitude
        const url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=" + latlng.lat + "&lon=" + latlng.lng;
        // Memanggil fungsi fetchDataLocation untuk mendapatkan data lokasi berdasarkan latitude dan longitude
        fetchDataLocation(url);
    }

    async function fetchDataLocation(url) {
        try {
            // Menggunakan fetch API untuk mengambil data dari URL yang diberikan
            const response = await fetch(url)

            // Menunggu hasil dari response dan mengkonversinya menjadi JSON
            const data = await response.json()

            console.log("result fetcch data", data);
            // Menetapkan nilai properti 'display_name' dari data ke elemen HTML dengan id 'description'
            document.getElementById('description').value = data.display_name
        } catch (error) {
            console.error(error);
        }
    }

    map.on('click', onMapClick);
}
// Fungsi Create Spot



// Fungsi Update Spot
function updateSpot() {
    const map = L.map('map').setView([51.505, -0.09], 13);
    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    const lat = document.getElementById('lat').value;
    const lng = document.getElementById('lng').value;
    const spotName = document.getElementById('name').value;

    console.log("result on fn updateSpot", lat, lng, spotName);

    const currentMarker = L.marker([lat, lng], { draggable: true }).bindPopup(spotName).addTo(map);
    const bounds = L.latLngBounds([currentMarker.getLatLng()]);
    map.fitBounds(bounds);
    map.setZoom(18)

    function onMapClick(e) {
       currentMarker.setLatLng(e.latlng);

        // Menetapkan nilai untuk elemen dengan id lat dan lng pada HTML (file create.blade.php)
        document.getElementById("lat").value = e.latlng.lat;
        document.getElementById("lng").value = e.latlng.lng;

        // Menggunakan API  untuk proses reverse geocoding dengan latitude dan longitude
        const url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=" + e.latlng.lat + "&lon=" + e.latlng.lng;
        // Memanggil fungsi fetchDataLocation untuk mendapatkan data lokasi berdasarkan latitude dan longitude
        fetchDataLocation(url);
    }

    async function fetchDataLocation(url) {
        try {
            // Menggunakan fetch API untuk mengambil data dari URL yang diberikan
            const response = await fetch(url)

            // Menunggu hasil dari response dan mengkonversinya menjadi JSON
            const data = await response.json()

            console.log("result fetcch data", data);
            // Menetapkan nilai properti 'display_name' dari data ke elemen HTML dengan id 'description'
            document.getElementById('description').value = data.display_name
        } catch (error) {
            console.error(error);
        }
    }

    currentMarker.on('dragend',function () {
        const latlng = currentMarker.getLatLng();
        document.getElementById("lat").value = latlng.lat;
        document.getElementById("lng").value = latlng.lng;

        // Menggunakan API  untuk proses reverse geocoding dengan latitude dan longitude
        const url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=" + latlng.lat + "&lon=" + latlng.lng;
        // Memanggil fungsi fetchDataLocation untuk mendapatkan data lokasi berdasarkan latitude dan longitude
        fetchDataLocation(url);
    })

    map.on('click', onMapClick)

}
// Fungsi Update Spot
