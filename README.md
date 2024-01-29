# InfoAuto API Consuming Example
A simple example of consuming of the infoauto Api used in a PHP project made in Yii2. In this example only the classes that consume the API are shown.

### Use examples
```
// php consuming file 

// Searhing car brands
$infoAuto = new InfoAutoService();
$search = "Rena";
$marcas = $infoAuto->marcas($search);// It wil be return Renault for example

// Searching the price of a specific car matching by it infoauto code (codia)
$infoAuto = new InfoAutoService();
$codia = "0123456"
$precio = $infoAuto->precio($codia);
```


### How it works ?
It searches if there is an existing valid token that is not expired. If it exists, that token is used, otherwise the login endpoint is consumed first to obtain the token, which is stored. Then the required endpoint is consumed.

![Class diagram](https://github.com/raulcori/InfoAutoAPIConsumingExample/blob/main/api-infoauto.png)
