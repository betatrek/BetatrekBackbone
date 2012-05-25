#!/bin/bash

# Create a temporary directory 
# Extract data 
while read line; do 
    echo -e "$line"; 
    TKR_SYM=$line

    # Parse the web page and update the scripts
    php -q parser.php ${TKR_SYM}
    # php -q parser.php ${DATA_DIR}/google/${TKR_SYM}.html > ${DATA_DIR}/${TKR_SYM}
    # Clean teh data 
done < $1

