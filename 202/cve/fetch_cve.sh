#!/bin/bash

echo "Fetch cve from CVE Project repository"

git clone https://github.com/CVEProject/cvelist.git

ROOT_DIR=$PWD
CVE_DIR="$ROOT_DIR/docs/cve/list/"
GENERATE_JSON=false
OUTPUT_JSON_DIR="$ROOT_DIR/docs/_data/"

cd ./cvelist

FILES=$(grep -Erli "(prestashop|security\.friendsofpresta\.org)")

for line in $FILES; do
  FILENAME="$PWD/$line"
  echo "Processing $FILENAME"
  RESULT=$(php "$ROOT_DIR/202/cve/process_cve.php" -- $FILENAME $CVE_DIR)
  echo "$RESULT"
done

RESULT=$(php "$ROOT_DIR/202/cve/generate_json.php" -- $CVE_DIR $OUTPUT_JSON_DIR)
echo "$RESULT"

cd ../
rm -Rf cvelist
