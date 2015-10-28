# all_email_util
Script that generates all potential emails of a person working at a company based on the first name, last name and domain name.
This is the perfect cold emailing tool.

##How to Use

This script is made to be called from the command line.

```
php email_script.php -f <first-name> -l <last-name> -d <domain>
```

The output can also be directly piped into a file.

The output is a comma-separated list, and can be directly dropped in GMail's list of recipients.

It is suggested that the list be dropped in "bcc" rather than "to". Looks a bit more professional ;)
