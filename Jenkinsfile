pipeline {
    agent any
    
    environment {
        DOCKERHUB_CREDENTIALS = credentials('dockerhub-credentials')  // create this in Jenkins if not exists
        IMAGE_NAME = 'tahasalam/wordpress-sqe'
    }

    stages {
        stage('Build Docker Image') {
            steps {
                sh """
                    docker build -t ${IMAGE_NAME}:${BUILD_NUMBER} .
                    docker tag ${IMAGE_NAME}:${BUILD_NUMBER} ${IMAGE_NAME}:latest
                """
            }
        }
        
        stage('Push to Docker Hub') {
            steps {
                sh '''
                    echo $DOCKERHUB_CREDENTIALS_PSW | docker login -u $DOCKERHUB_CREDENTIALS_USR --password-stdin
                    docker push ${IMAGE_NAME}:${BUILD_NUMBER}
                    docker push ${IMAGE_NAME}:latest
                    docker logout
                '''
            }
        }
        
        stage('Cleanup') {
            steps {
                sh '''
                    docker rmi ${IMAGE_NAME}:${BUILD_NUMBER}
                    docker rmi ${IMAGE_NAME}:latest || true
                '''
            }
        }
    }
}