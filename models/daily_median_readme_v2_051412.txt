Release Notes (updated 5/9/12)

To generate daily water-level surfaces for the Everglades, a Daily Median program is run to create the input to the 
EDEN surface-water model. The EDEN database generates the median_flag.txt file which provides users with a list of 
the daily median value and data type for each of the gages used in the surface-water model. The daily file is 
identified as the Daily Median Output file on the EDENweb. The filename format is YYYYMMDD_median_flag.txt including 
the date of the water-level data and associated surface. This file is described in the metadata for the EDEN Water 
Surfaces Data. Knowing which gages are used in the creation of a day’s water-level surface is useful for users with 
specific confidence requirements or for identifying differences in daily surfaces.

Daily Median Output files (YYYYMMDD_median_flag.txt):
These .txt files contain a list of gages and water-level data that are used to create the water surface for that day. 
The file contains the following information for each gage:

Agency = operating agency for gage (NPS, SFWMD, or USGS)
Station = EDEN station name
X = UTM Easting coordinate (UTM, zone 17N, NAD83)
Y = UTM Northing coordinate (UTM, zone 17N, NAD83)
Daily Median Water Level (cm, NAVD88) = daily median water level for gage for date specified, in centimeters (NA if 
data is missing for a gage and gage is not used for daily water level surface)
Date = date of water level (YYYYMMDD)
Data Type = Type of data collected at the gage for the day; “O” for observed or measured data,”M” for missing data, 
“E” for estimated data, and “D” for dry conditions at the gage. 

For Data type, conditions at the gage are considered dry (D) if the daily median is equal to or below the average 
ground elevation at the gage. If the data at a gage is determined to be dry, the data is not identified as measured, 
estimated, or missing. Missing data (M) means that all hourly data for that day is missing for the gage. If a single 
hourly value is measured, a daily median is computed and identified as data type of measured (O). Estimated data (E) 
means that every one of the hourly values is estimated for that day at the gage.

The previously provided reject file is no longer provided because the revised daily median file provides a list of 
the gages not used in the daily surfaces.
