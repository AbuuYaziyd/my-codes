name: CI-SFTP

# Controls when the action will run. 
on:
  # Triggers the workflow on push or pull request events but only for the main branch
  push:
    branches: [ main ]
#  pull_request:
#    branches: [ main ]

  # Allows you to run this workflow manually from the Actions tab
  workflow_dispatch:

# A workflow run is made up of one or more jobs that can run sequentially or in parallel
jobs:
  # This workflow contains a single job called "SFTP"
  deploy-via-sftp:
    runs-on: ubuntu-latest
    steps:
      # Checks-out your repository under $GITHUB_WORKSPACE, so your job can access it
      - uses: actions/checkout@v2
          
      - name: SFTP Deploy
        uses: wlixcc/SFTP-Deploy-Action@v1.2.1
        with:
          username: logicism
          server: logicism.ddns.net
          port: 22 # default is 22
          ssh_private_key: ${{ secrets.SSH_PRIVATE_KEY }}

          
          # will put all file under this path
          local_path: ./* # default is ./*
          # files will copy to under remote_path
          remote_path: /var/www
          
          # sftp args
          args: '-o ConnectTimeout=5'