# LangAPI
Lang API 
#DEPENDS [LangInitializer](https://github.com/MlsDmitry/LocalInitializer)
#**Usage**
Create an instance of Lang object and pass Plugin implemented object. 
Just your main(that extends from PluginBase) class 
```php
new \mlsdmitry\LangAPI\Lang($this);
```
Then call wherever you need to send message to player
```php 
Lang::get('message-from-yml', array_of_replaces, $player)
``` 
######$player need to get player's native lang.
#Example
#####en_EN.yml:
```yaml
player-offline: "Player {nickname} is offline"
```
Somewhere in code:
```php
\mlsdmitry\LangAPI\Lang::get('player-offline', ['nickname' => 'MlsDmitry'], $player);
```
Output: <br>
"Player MlsDmitry is offline"
###Done!
#Useful information for developers:
>When you create Lang instance it's automatically addes language folder in plugin_data of your plugin.
>
>There you can add language files for example **en_EN.yml**
