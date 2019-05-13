# node_output_demo

INTRODUCTION

This module will expose Drupal node as JSON output. This module provides a URL that responds with a JSON representation of a given node with the content type "page" also authenticated with Site API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".
Example: [site-url]/demo/siteapikey/1 = "siteapikey" api key and '1' is nid
