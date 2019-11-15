npm run build

echo "Removing JS and view templates from previous build"
rm -rf ../ui/assets/map/
rm ../ui/application/views/map.php

echo "Copying files from /build folder"
cp -r ./build/static ../ui/assets/map
cp ./build/map.php ../ui/application/views/.
