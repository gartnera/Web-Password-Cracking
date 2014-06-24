Web-Password-Cracking
=====================

The intent of this project is to provide a web interface for password cracking, currently through hashcat/oclHashcat. I primarily developed it for Dakota State University, however it could easily be rebranded.

Currently implemented features:

* Multi-user login, creation, and confirmation
* User submission of jobs
  * Users select hash types, paste in hashes, and select attack type
  * Attack types include brute force (?a?a?a?a?a?a?a?a?a) and custom mask
* Queueing and running of jobs
* Active display of job status and job results

Planned features:

* Populating graphs with actual statistics
* Adding additional attack types (dictionary, rainbow table)
* Implementing job runtime limits
* Based on those limits, provide users with an estimated time of completion/start based on what's currently in the queue
* Functionality where users can lookup hashes that have already been cracked
