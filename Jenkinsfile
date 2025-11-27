pipeline {
    agent any
    stages {
        stage('Build Docker Image') {
            steps {
                script {
                    docker.build("tahasalam/wordpress-sqe:${env.BUILD_NUMBER}")
                }
            }
        }
        stage('Push to Docker Hub') {
            steps {
                script {
                    docker.withRegistry('', 'dockerhub-credentials') {
                        docker.image("tahasalam/wordpress-sqe:${env.BUILD_NUMBER}").push()
                        docker.image("tahasalam/wordpress-sqe:${env.BUILD_NUMBER}").push('latest')
                    }
                }
            }
        }
    }
}
