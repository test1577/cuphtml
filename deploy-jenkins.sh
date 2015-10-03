#!/bin/bash

################### Define variable ####################
####################### Command ###################
clear
SAVEIF=$IFS
IFS=$(echo -en "\n\b")
echo "=========Deploy Command to Unipower System with jenkins By TON3DS========="

BASEDIR=$(dirname $0)

function deploy {
	cd $BASEDIR
	server=$1
	if [ "$server" = "testsite" ]; then
		deployTestsite
	elif [ "$server" = "production" ]; then
		deployProducti
	elif [ "$server" = "cuphtml" ]; then
		deployCUPHTML
	fi
}

function deployCUPHTML {
	cmd=$(rsync -rlczPe "ssh -i /var/jenkins_home/jobs/CUPHTML/workspace" \
		--delete --exclude-from=${WORKSPACE}/.deploy-ignore \
		${WORKSPACE}/. ubuntu@103.22.180.250:/websites/cuphtml.com/public_html)
	echo $cmd
}


function deployTestsite {
	cmd=$(rsync -rlczPe "ssh -i /var/jenkins/3dsinteractive.pem" \
		--delete --exclude-from=${WORKSPACE}/.deploy-ignore \
		${WORKSPACE}/. ubuntu@54.254.101.216:/websites/unp.sitespad.com/public_html)
	echo $cmd
}

function deployProduction {
	syncFileProd
	compressFileProd
	moveZipToBackup
	moveFileToSrcMaster
}

function syncFileProd {
	cmd=$(rsync -rlczP --delete --exclude-from=${WORKSPACE}/api/.deploy-ignore \
		${WORKSPACE}/api/. ${JENKINS_HOME}/jobs/${JOB_NAME}/source )
	cmd_config=$(rsync -rlczP ${JENKINS_HOME}/jobs/${JOB_NAME}/config/. ${JENKINS_HOME}/jobs/${JOB_NAME}/source)
	cmd_htaccess=$(cp ${JENKINS_HOME}/jobs/${JOB_NAME}/config/.htaccess ${JENKINS_HOME}/jobs/${JOB_NAME}/source/.htaccess)
	echo $cmd
	echo $cmd_config
	echo cmd_htaccess

}
function compressFileProd {
	cd ${JENKINS_HOME}/jobs/${JOB_NAME}/source
	cmd=$(tar -cvzf tesco2015-$(getDateNow).tar.gz .)
	echo $cmd
}

function moveZipToBackup {
	cmd=$(mv ${JENKINS_HOME}/jobs/${JOB_NAME}/source/tesco2015-$(getDateNow).tar.gz ${JENKINS_HOME}/jobs/${JOB_NAME}/backup/.)
	echo $cmd
}
function moveFileToSrcMaster {
	cmd=$(scp -i ${JENKINS_HOME}/tesco2015-api-master.pem ${JENKINS_HOME}/jobs/${JOB_NAME}/backup/tesco2015-$(getDateNow).tar.gz ubuntu@52.74.170.107:/var/www/html/code.tar.gz)
}

function getDateNow {
	echo $(date +"%m-%d-%y")
}

deploy $1