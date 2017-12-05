UPGRADE FROM 0.x to 1.0
=======================

### Removal of Entity

 * In 1.0 we've removed the `User` and `Group` entity. This is because there are alot of situations where you need to define your own custom fields for `User` and `Group`. To be compatible with 1.0, please [redo the installation guide step 3 and 4](https://github.com/wearejust/user-bundle/blob/1.x/README.md#step-3-define-your-usergroup-entity)
  
### Finally, change your composer.json
 * Don't forget to add the new version to your own composer.json file

    ```json
    # composer.json
    {
        "require": {
            "wearejust/user-bundle": "^1.0"
        }
    }
    ```
    
    And run the following command:
    
    ```composer update wearejust/user-bundle --with-dependencies```
