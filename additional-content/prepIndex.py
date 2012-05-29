# This file was created by Sean McKenna to convert values
# of an index into a CSV file for parsing into a database

# Defines the CSV data filenames
inFile = "index.txt"
outFile = "index.csv"

# Necessary imports
import re

# Several regular expressions
# top or 'p' is what is used here to get pages
p = re.compile('[0-9]{1,3}[A-Z]{0,1}[\n, ]{1}')
p0 = re.compile('[A-za-z0-9,. \n]+')
p1 = re.compile('[0-9]+')
p2 = re.compile('[0-9]+[A-Z]?[,]*?')
p3 = re.compile('[^0-9\W,]{0,1}([0-9]){1,3}[^0-9\W,]{0,1}')

# Get the text file as input
input = open(inFile, 'rU')
reader = input.readlines()

# Prep output file/s
output = open(outFile, 'wb')

# Process CSV file, row-by-row
for row in reader:

  # strip out ending whitespace
  row = row.rstrip(' \t\r')

  # first, grab all the matching pages
  m = re.findall(p, row)

  # only print out line if we find pages
  if m is not None:

    # strip out the pages from the string
    n = re.subn(p, '', row)
    if n is not None:

      # leave first comma in that index string
      row = n[0]
      row = row.replace(',', '`', 1)
      row = row.replace(',', '')
      row = row.replace('`', ',', 1)

      # strip out whitespace, remove trailing commas
      row = row.strip()
      if row[-1] == ',':
        row = row.replace(',', '')
        row = row.strip()
      index = row

    # finalize index and initialize pages var
    index += ';'
    pages = ''

    # for each page we caught with our regex
    for m2 in m:

      # remove commas and whitespace
      m2 = m2.replace(',', '')
      m2 = m2.strip()

      # create a CSV list
      pages += m2 + ','

  # remove final comma, add new line
  pages = pages[0:-1] + '\n'

  # combine index and pages and print to file
  line = index + pages
  output.write(line)
 
# Close all files
input.close()
output.close()

print 'Processing of the index complete!'
