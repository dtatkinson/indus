import json
import csv
import time
#------------------------------------------------------------------------------------------------------------------------
#SETTINGS
'''Columns to extract'''
EXTRACTS = ["providerId","providerName","providerStreetAddress","providerCity","providerState","providerZipCode","hospitalReferralRegionHRRDescription"]
'''
Put the exact name of the column in the list
'''

'''Conditions'''
CONDITIONS = {}
'''
Type condition in the format {columnName: "value"}
'''

'''Unique fields'''
UNIQUES = ["providerId"]
'''
Use to extract row based on unique values
'''

'''dRGDefinition split names'''
dRGDefinition_code = "drgd_code"
dRGDefinition_description = "drgd_description"

'''File names'''
INPUT_FILE = "DRGChargesData.json"
OUTPUT_FILE = "hospital_info.csv"
#------------------------------------------------------------------------------------------------------------------------



p_json = json.load(open(INPUT_FILE))

def main():
    with open("csvs/{}".format(OUTPUT_FILE), "w", newline="") as outcsv:
        #Create writer
        writer = csv.writer(outcsv)

        #Write header
        writer.writerow(EXTRACTS)

        #Prepare the blacklist
        blacklist = {}
        for unique in UNIQUES:
            blacklist[unique] = []

        #Write data in csv
        for data in p_json:
            to_write = []
            allow_continue = True

            if len(CONDITIONS) > 0:
                '''Condition testing'''
                for condition in CONDITIONS:
                    if data[condition] != CONDITIONS[condition]:
                        allow_continue = False
                        break

            '''If condition passed extract the good stuff'''
            if allow_continue:
                '''Fields extraction'''
                for extract in EXTRACTS:
                    '''Test if the field column is in the data'''
                    if extract not in data and extract != "code" and extract != "description":
                        allow_continue = False
                        break

                    '''dRGDefinition extract (if required)'''
                    if ("code" in EXTRACTS or "description" in EXTRACTS):
                        if(len(data["dRGDefinition"]) > 0):
                            if extract == "code":
                                data[extract] = data["dRGDefinition"].split(" - ")[0]
                            elif extract == "description":
                                data[extract] = data["dRGDefinition"].split(" - ")[1]
                        else:
                            allow_continue = False
                            break

                    '''Unique testing'''
                    if extract in UNIQUES:
                        print(data[extract])
                        if data[extract] in blacklist[extract]:
                            print("Is unique")
                            allow_continue = False
                            break
                        else:
                            blacklist[extract].append(data[extract])
                            print("Is not unique")
                    to_write.append(data[extract])

                if allow_continue:
                    writer.writerow(to_write)
                #time.sleep(1)
        outcsv.close()


if __name__ == "__main__":
    main()
