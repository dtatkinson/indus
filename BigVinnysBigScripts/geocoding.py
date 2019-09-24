from geopy.geocoders import GoogleV3
import geopy
import csv
import time

API_KEY = "AIzaSyAWOLJZDit5LJs6RhOe2fjY3hJUKnqJjvs"

INPUT_FILE = "hospital_info.csv"
OUTPUT_FILE = "coordinates.csv"

hospital_name_column = "providerName"

def main():
    with open(INPUT_FILE, "r") as incsv, open(OUTPUT_FILE, "w") as outcsv:
        reader = csv.reader(incsv)
        writer = csv.writer(outcsv)

        writer.writerow(["providerName","latitude","longitude"])

        skip_header = True
        missing_coords = []


        for row in reader:
            #Skip header
            if skip_header:
                skip_header = False
                continue

            #Get hospital data
            hospital_name = row[1]
            hospital_street = row[2]
            hospital_city = row[3]
            hospital_postcode = row[5]
            print(hospital_name)
            try:
                #print("Attempting {}".format(hospital_name))
                location = GoogleV3(api_key=API_KEY, timeout=10).geocode("{} {} {}".format(hospital_name,hospital_street,hospital_postcode))
                writer.writerow([hospital_name,location.latitude,location.longitude])
                print("OK\n")
            except AttributeError:
                print("MISSING\n")
                missing_coords.append(hospital_name)
        #time.sleep(1)
    outcsv.close()
    print("Missing coords for:")
    for hosp in missing_coords:
        print("\t {}".format(hosp))

if __name__ == "__main__":
    main()
