properties([pipelineTriggers([githubPush()])])

pipeline {
    agent any

    stages {

        stage('Build') {
            steps {
                sh '''
                    echo Building...
                    docker run -d --name movie_listing-test\
                    -v /home/guille/dockers/jenkins/volumes/home/workspace/movie_listing-pipeline-push_github:/var/www/html \
                    -w /var/www/html \
                    movie_listing
                '''
            }
        }

        stage('Test') {
            steps {
                sh 'echo Testing...'
            }
        }

        stage('Push') {
            steps {
                sh 'echo Pushing image to Dockerhub...'
            }
        }

        stage('Deploy') {
            steps {
                sh 'echo Deploying image in Prod...'
            }
        }
    }
}