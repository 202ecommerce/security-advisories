#!/bin/bash

echo "Fetch cve from CVE Project repository"

git clone https://github.com/CVEProject/cvelist.git

ROOT_DIR=$PWD
CVE_DIR="$ROOT_DIR/docs/cve/list/"
GENERATE_JSON=false
OUTPUT_JSON_DIR="$ROOT_DIR/docs/_data/"

cd ./cvelist

FILES=$(grep -rli "prestashop")

for line in $FILES; do
  FILENAME="$PWD/$line"
  echo "Processing $FILENAME"
  RESULT=$(php "$ROOT_DIR/202/cve/process_cve.php" -- $FILENAME $CVE_DIR)
  if [ "$RESULT" = "SUCCESS" ]; then
    GENERATE_JSON=true
  fi
done

if [ "$GENERATE_JSON" = true ]; then
  php "$ROOT_DIR/202/cve/generate_json.php" -- $CVE_DIR $OUTPUT_JSON_DIR
fi

cd ../
rm -Rf cvelist