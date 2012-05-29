# This file was created by Sean McKenna to convert values
# of an index into a CSV file for parsing into a database
# it uses page conversion from an external CSV file

# Defines the CSV data filenames
inFile = "index.txt"
parseFile = "centennial-book-pages.csv"
outFile = "index.csv"

# Necessary imports
import re
import csv

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

# Grab the CSV file for conversion
parse = open(parseFile, 'rU')
parser = csv.reader(parse)

# Prep output file/s
output = open(outFile, 'wb')

# Keep track of errors
errors = 0

# Turn parser into a dictionary
parseTree = {}
for row in parser:
  parseTree[row[0]] = row[1]

# Process original index file, row-by-row
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

    # null value for no index given
    else:
      index = 'NULL'
      errors += 1

    # get the first char of index
    char = index[0].upper()

    # initialize pages var
    pages = ''

    # for each page we caught with our regex
    for m2 in m:

      # remove commas and whitespace
      m2 = m2.replace(',', '')
      m2 = m2.strip()

      # check parser file for page key and set value
      if parseTree.has_key(m2):
        page = parseTree[m2]

      # if not found, print error and NULL value
      else:
        page = 'NULL(' + m2 + ')'
        errors += 1

      # create a CSV list of pages
      pages += page + ','

  # remove final comma, add new line
  pages = pages[0:-1] + '\n'

  # combine index and pages and print to file
  line = char + ';' + index + ';' + pages
  output.write(line)
 
# Close all files
input.close()
parse.close()
output.close()

# If no errors, print a success message
if errors == 0:
  print 'Processing of the index complete!'

# Otherwise, print how many errors were found
else:
  print 'There were ' + str(errors) + ' errors while processing the index.'
