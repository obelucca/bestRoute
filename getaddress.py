from geopy.geocoders import Nominatim

geolocator = Nominatim(user_agent="BestRoute")
location = geolocator.geocode("Av. Cristiano Machado, 11833 - Vila Cloris, Belo Horizonte - MG, 31744-007")

print(location.point)