npm run build

echo "Removing JS and view templates from previous build"
rm -rf ../ui/assets/map/
rm ../ui/application/views/map.php

echo "Copying files from /build folder"
mkdir ../ui/assets/map
cp -r ./build/js ../ui/assets/map/.
cp -r ./build/css ../ui/assets/map/.
cp ./build/map.php ../ui/application/views/.
