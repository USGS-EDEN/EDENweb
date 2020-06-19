A daily median water level is calculated for each water-level gage used in the 
EDEN surface-water model. A program called Daily Median Server is run daily to 
create the MEDIAN.TXT file which is input to the EDEN surface-water model and 
the MEDIAN_REJECT.TXT file which identifies which gages had no daily data and 
were therefore not used in the model. Collectively, these two daily files are 
identified as the Daily Median Output Files on the EDENweb. The file name 
formats for these files are YYYYMMDD_median.txt and 
YYYYMMDD_median_reject.txt, respectively. These files are described in the 
metadata for the EDEN Water Surfaces Data. Knowing which gages are used in the 
creation of a day’s water-level surface is useful for users with specific 
confidence requirements or for identifying differences in daily surfaces.




MEDIAN.TXT FILES:
The median files contain a list of stations that were used to create the water 
surface for that day.  The file contains the following information for each 
gage:

Agency, Station name used by the model, UTM (Easting), UTM (Northing), Daily 
median Water Value (centimeters), Year, Month, Day, determination of Head or 
Tail Gage (Optional), Area of location

The corresponding column headers are: 
Agency, Station, X, Y, Daily median water level (in cm), Year, Month, Day, 
Head_Tail, Area

The files list one gage per line and the columns are tab-delimited. 


MEDIAN_REJECT.TXT FILES:
The median_reject files contain a list of gages that did not have sufficient 
data to be used to create that day’s water-level surface. Gages are grouped 
alphabetically by operating agency. If this file is blank, all gages were used 
in the creation of the water surface that day.


