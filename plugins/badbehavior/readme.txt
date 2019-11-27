Plugin: Bad Behavior Integration
Author: The LifeType Team
Release Date: 2006/07/25

This plugin offers anti-spam protection powered by Bad Behavior (http://www.bad-behavior.ioerror.us/).

Although Bad Behavior is already included with LifeType since version 1.2 you might need to configure your template to take full advantage of Bad Behavior. Follow the steps below to add Bad Behavior to your template.
1. Refresh the plugin center until you see the badbehavior plugin appers.
2. Add the following scripts to header.template between <head></head>

    {if !empty($badbehavior)}
      {$badbehavior->showBB2JavaScript()}
    {/if}


You also can use the followings method to get some useful information:
1. Use {$badbehavior->showBB2Timer()} to get the badbehavior timer
2. Use {$badbehavior->showBB2Status()} to get the badbehavior status

To Do:
1. Add an admin panel to review the blocked spams
