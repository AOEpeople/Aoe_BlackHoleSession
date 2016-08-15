# AOE_BlackHoleSession

Author: [Fabrizio Branca](https://twitter.com/fbrnc)

See: https://github.com/colinmollenhour/Cm_RedisSession/issues/91

Bots (including load balancers and reverse proxies) will create many sessions that will never be used again.
Instead we're detecting them based on the user agent and will skip creating a real session.

## Configuration

Add this to your local.xml file:

```
<?xml version="1.0" encoding="UTF-8"?>
<config>
    <global>
        [...]
        <aoeblackholesession>
            <bot_regex><![CDATA[/^elb-healthchecker/i]]></bot_regex>
        </aoeblackholesession>
        [...]
    </global>
</config>
```