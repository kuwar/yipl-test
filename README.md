# yipl-test
csv test

# Project Details
Read two csv file (contracts.csv and awards.csv) and outupt another csv (final.csv). final.csv combined result according common field contractName. In the final csv latitude and longitude of the place is added using google map api. The total amount of closed contract is calculated and displayed.

The index page list all the contractName of the final.csv. On clicking, individual contract name, the detail of contract is shown and is also located in the map.

# Installation Procedure
Upload to web server.
Upload contracts.csv and awards.csv to uploads directory in the root folder.
Browse base_url/contracts.php (ie. yipl-test/contracts.php). final.csv file will be generated and saved in the directory uploads.
Browse to base_url/index.php (ie. yipl-test/index.php) and will get details view of contracts along with google map.

# Dependencies
latest version of jQuery
latest version of bootstrap
google map api
