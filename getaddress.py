from flask import Flask, request, jsonify
from geopy.geocoders import Nominatim

app = Flask(__name__)
geolocator = Nominatim(user_agent="BestRoute")

@app.route('/geocode', methods=['GET'])

def geocode():
    address = request.args.get('address', '')
    location = geolocator.geocode(address)

    if location:
        latitude = location.latitude
        longitude = location.longitude
        return jsonify({'latitude': latitude, 'longitude': longitude})
    else: 
        return jsonify({'error': 'Não foi possível obter informações dessa  localização.'})
    
if __name__ == '__main__':
    app.run(debug=True)