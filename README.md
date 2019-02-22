
  
# Paradox.ai Olivia - PHP SDK    
 Version: 1.0    
    
This is an unofficial PHP SDK developed for use with version 1.0 of the Paradox.ai Olivia API.    
    
Official documentation can be [found here](https://paradox.readme.io/v1.0/reference).    
    
    
## Getting Started    
 Include the library via [composer]()    
    
``` composer require darkgoldblade01/paradox-ai-php-sdk ```    
 Once included, make sure you have the following from Paradox:    
    
 - Account ID    
 - Secret Key    
 - UID    
     
 These are required to generate the JWT token used.    
     
 ## Initializing the API    
 To initialize the API is simple, just create a new instance of Olivia, and include the Account ID, Secret Key, and UID:    
     
 ```php
 $olivia = new \darkgoldblade01\Paradox\Olivia\Olivia($account_id, $secret_key, $uid)
 ```     
 From there, you are ready to start interacting with the API!    
     
     
 ## `$olivia->company()`
Returns the company resource.
  #### `get_conversations($conversations)`    
 | Parameter | Type | Default |  
|--|--|--|  
| `$conversations` | bool | true  
  
Returns a list of company conversations.    
  
  #### `get_locations($locations)`    
 | Parameter | Type | Default |  
|--|--|--|  
| `$locations` | bool | true  
  
Returns a list of all company locations.    
  
  #### `get_ai_assistant()`    
 | Parameter | Type | Default |  
|--|--|--|  
  
Returns the AI assistant's name and image.    
  
---